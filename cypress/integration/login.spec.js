describe("The Login Page", () => {
    beforeEach(() => {
        // reset and seed the database prior to every test
        cy.refreshDatabase();
    });

    it("Invalid credentials should not log in.", function () {
        cy.visit("login");
        cy.get("#email").clear();
        cy.get("#email").type("test@test.com");
        cy.get("#password").clear();
        cy.get("#password").type("testing");
        cy.get(".ml-2").click();
        cy.get(".checkbox").check();
        cy.get(".btn").click();
        cy.get(".font-medium").should(
            "have.text",
            "Whoops! Something went wrong."
        );
    });
});
