<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlockStoreRequest;
use App\Http\Requests\BlockUpdateRequest;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $blocks = Block::all();

        return view('block.index', compact('blocks'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('block.create');
    }

    /**
     * @param \App\Http\Requests\BlockStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlockStoreRequest $request)
    {
        $block = Block::create($request->validated());

        $request->session()->flash('block.id', $block->id);

        return redirect()->route('block.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Block $block)
    {
        return view('block.show', compact('block'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Block $block)
    {
        return view('block.edit', compact('block'));
    }

    /**
     * @param \App\Http\Requests\BlockUpdateRequest $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function update(BlockUpdateRequest $request, Block $block)
    {
        $block->update($request->validated());

        $request->session()->flash('block.id', $block->id);

        return redirect()->route('block.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Block $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Block $block)
    {
        $block->delete();

        return redirect()->route('block.index');
    }
}
