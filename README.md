# kirby-recent-changes
Shows the recent page updates as a page section in the panel

## Requirements
You need at least Kirby CMS v3.0.
This Plugin does not work with Kirby 2.

## 1. Installation
Copy or clone this repository into your `/site/plugins` directory and rename the folder to `recent-changes`.

## 2. Example Blueprint setup
```yaml
sections:
  yourPageFieldKey:
    type: recentChanges
    headline: Recent Changes
    image: cover
    dateFormat: d.m.Y
    sortBy: modified desc
    limit: 5
    filterBy: intendedTemplate == blog-post
```

## Customization

`headline` - Custom section headline
> Type: String (optional), default to 'Recent Changes'.

`image` - Custom preview image
> Type: String (optional), default to the page's first image.

`dateFormat` - Custom date format
> Type: String (optional), default to "d.m.Y"

`sortBy` - Custom sort key and order
> Type: String (optional), default "modified desc"<br>
> You can also provide a custom field and search order, e.g. `"customDateInput asc"`

`limit` - You can set a limit for the amount of pages you want to display.
> Type: Integer (optional), default "5"

`filterBy` - Custom filter method
> Type: String (optional), all pages are shown by default<br>
> You can filter the pages by the kirby filter method: https://getkirby.com/docs/reference/objects/pages/filter-by#available-filter-methods
> Seperate the arguments with a space.
