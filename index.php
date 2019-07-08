<?php

Kirby::plugin('zvaehn/recent-changes', [
  'sections' => [
    'recentChanges' => [
      'props' => [
        'headline' => function ($headline = 'Recent Changes') {
          return $headline;
        },
        'image' => function ($image = false) {
          return $image;
        },
        'dateFormat' => function ($dateFormat = 'd.m.Y') {
          return $dateFormat;
        },
        'sortBy' => function ($sortBy = 'modified desc') {
          return explode(" ", $sortBy);
        },
        'filterBy' => function ($filterBy = false) {
          if($filterBy) {
            return explode(" ", $filterBy);
          }

          return false;
        },
        'limit' => function ($limit = 10) {
          return $limit;
        },
      ],
      'methods' => [
        'getIndex' => function() {
          $index = site()->index();

          if($this->filterBy()) {
            $index = $index->filterBy(...$this->filterBy());
          }

          $index = $index->sortBy(...$this->sortBy());
          $index = $index->limit($this->limit());

          return $index;
        },
        'getThumbUrl' => function($page) {
          $image = false;

          // do we want to have a custom image?
          if($this->image()) {
            if($field = $page->{$this->image()}()) {
              $image = $field->toFile();
            }
          }

          // if the custom image is invalid or not found
          if(!$image) {
            $image = $page->image();
          }

          // Generate a thumb or return an empty string if the page has no image
          return $image ? $image->thumb(array('width' => 48))->url() : '';
        },
      ],
      'computed' => [
        'items' => function() {
          $items = array();

          foreach ($this->getIndex() as $page) {
            $item = array(
              'image' => array(
                'url' => $this->getThumbUrl($page),
                'back' => 'pattern',
              ),
              'text' => $page->title()->value(),
              'info' => date($this->dateFormat(), $page->modified()),
              // 'flag' => array(
              //   'icon' => 'edit',
              //   'click' => 'editClickHandler', // https://getkirby.com/docs/reference/plugins/ui/list-item#events
              // ),
              'link' => $page->panelUrl(),
              'target' => '_blank'
            );

            array_push($items, $item);
          }

          return $items;
        }
      ],
    ]
  ]
]);
