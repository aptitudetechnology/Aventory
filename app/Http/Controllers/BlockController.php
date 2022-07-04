<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockStoreRequest;
use App\Http\Requests\BlockUpdateRequest;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;

class BlockController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('viewAny', Block::class);

        $blocks = $this->getBlocks();
        $blocks->load('nurseryLocation');
        return inertia('Blocks/Index', compact('blocks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        Gate::authorize('create', Block::class);

        $blocks = $this->getBlocks();
        $blocks->load('nurseryLocation');
        $locations = auth()->user()->currentTeam->nurseryLocations;

        return inertia('Blocks/Create', compact('blocks', 'locations'));
    }

    /**
     * @param \App\Http\Requests\BlockStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockStoreRequest $request)
    {
        Gate::authorize('create', Block::class);

        $block = $request->user()->currentTeam->blocks()->create($request->validated());

        $request->session()->flash('block.id', $block->id);

        return redirect()->route('blocks.show', $block)->banner("Created new block!");
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Block $block)
    {
        Gate::authorize('view', $block);

        $blocks = $this->getBlocks();

        $blocks->load('nurseryLocation');
        $places = cache()->rememberForever($block->id . 'places', function () use ($block) {
            return $block->places;
        });

        $locations = auth()->user()->currentTeam->nurseryLocations;
        return inertia('Blocks/Edit', compact('block', 'blocks', 'locations', 'places'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Block $block)
    {
        $block->load('nurseryLocation');
        return redirect()->route('blocks.show', $block);
    }

    /**
     * @param \App\Http\Requests\BlockUpdateRequest $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function update(BlockUpdateRequest $request, Block $block)
    {
        Gate::authorize('update', $block);
        $block->update($request->validated());

        $request->session()->flash('block.id', $block->id);

        return redirect()->back()->banner("Updated Block!");
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Block $block)
    {
        Gate::authorize('delete', $block);

        $block->delete();

        return redirect()->route('blocks.index');
    }

    protected function getBlocks()
    {
        return auth()->user()->currentTeam->blocks;
    }
}
