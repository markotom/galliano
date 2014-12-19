// Feed Model
var FeedModel = Backbone.Model.extend({
  defaults: {
    message: '',
    text: ''
  }
});

// Feed Collection
var FeedCollection = Backbone.Collection.extend({
  model: FeedModel,
  url: function () {
    return this._url + '/' + this.limit;
  },
  initialize: function (options) {
    options = options || {};
    this.limit = options.limit || 10;
    this._url  = options.url;
  },
  parse: function (data) {
    var models = [];

    _.each(data, function (model) {
      models.push(model);
    });

    return models;
  }
});

// Feed List View
var FeedListView = Backbone.View.extend({
  initialize: function (options) {
    this.options = options || {};
    this.listenTo(this.collection, 'sync', this.render);
  },
  render: function () {
    this.$el.empty();

    this.collection.each(function (model) {
      if (model.attributes.text || model.attributes.message) {
        var view = new FeedItemView({
          model: model,
          template: $(this.options.childTemplate).html()
        });

        this.$el.append(view.el);
      }
    }, this);

    // Rebuild fullpage to prevent 100% height
    jQuery('.wrapper').fullpage.reBuild();

    return this;
  }
});

// Feed Item View
var FeedItemView = Backbone.View.extend({
  className: 'item',
  initialize: function (options) {
    this.template = _.template(options.template);
    this.render();
  },
  render: function () {
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  }
});

// Feed List View (photos)
var PhotoListView = Backbone.View.extend({
  initialize: function (options) {
    this.options = options || {};
    this.listenTo(this.collection, 'sync', this.render);
  },
  render: function () {
    this.$el.empty();

    var item_index = 1;

    this.collection.each(function (model) {
      var view = new PhotoItemView({
        model: model,
        className: 'item item-' + item_index,
        template: $(this.options.childTemplate).html()
      });

      this.$el.append(view.el);

      item_index++;
    }, this);

    this.$el.append('<div class="grid-sizer"></div>');

    this.$el.masonry({
      itemSelector: '.item',
      columnWidth: '.grid-sizer',
      transitionDuration: '0.1s'
    });

    this.$el.find('.instagram-lightbox').magnificPopup({
      image: {
        titleSrc: function(item) {
          var title,
              href     = item.el.attr('href'),
              caption  = item.el.attr('data-title'),
              comments = item.el.attr('data-comments'),
              likes    = item.el.attr('data-likes');

          title = '<a href="' + href + '">' + caption + '</a>';
          title += '<small>';
          title += '<i class="fa fa-heart"></i> ' + likes + ' les gusta esto';
          title += ' <i class="fa fa-comment"></i> ' + comments + ' comentarios';
          title += '</small>';

          return title;
        }
      }
    });

    return this;
  }
});

// Feed Item View (photos)
var PhotoItemView = Backbone.View.extend({
  initialize: function (options) {
    this.template = _.template(options.template);
    this.className = options.className;
    this.render();
  },
  render: function () {
    this.$el.html(this.template(this.model.toJSON()));
    return this;
  }
});

jQuery(document).ready(function ($) {

  var photos = new FeedCollection({
    url: instagram_options.url,
    limit: instagram_options.limit
  });

  var photosView = new PhotoListView({
    el: '.instagram',
    collection: photos,
    childTemplate: '#photo-template'
  });

  var tweets = new FeedCollection({
    url: twitter_options.url,
    limit: twitter_options.limit
  });

  var tweetsView = new FeedListView({
    el: '.twitter.feed',
    collection: tweets,
    childTemplate: '#tweet-template'
  });

  var statuses = new FeedCollection({
    url: facebook_options.url,
    limit: facebook_options.limit
  });

  var statusesView = new FeedListView({
    el: '.facebook.feed',
    collection: statuses,
    childTemplate: '#status-template'
  });

  // Get photos from Instagram
  photos.fetch();

  // Get tweets from Twitter
  tweets.fetch();

  // Get statuses from Facebook
  statuses.fetch();

});
