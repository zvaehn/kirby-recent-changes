panel.plugin('zvaehn/recent-changes', {
  sections: {
    recentChanges: {
      data: function () {
        return {
          headline: null,
          items: null
        }
      },
      methods: {
        action(type) {
          alert(type);
        },
        editClickHandler(obj) {
          alert(obj.toString());
        },
      },
      created: function() {
        this.load().then(response => {
          this.headline = response.headline;
          this.items    = response.items;
        });
      },
      template: `
        <section class="k-modified-section" type="pages">
          <header class="k-section-header">
            <k-headline>{{ headline }}</k-headline>
          </header>
          <div class="k-collection" data-layout="list">
            <k-list :items="items"></k-list>
          </div>
        </section>
      `
    }
  }
});
