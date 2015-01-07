# Install

Before you need install [Node.js](http://nodejs.org) and [Bower](http://bower.io), then install the dependencies:

```bash
$ npm install && bower install
```

# Contribute

To contribute with [Browser Sync](http://www.browsersync.io), just run:

```bash
$ gulp
```

# Build

Build styles on production or development:

```bash
$ gulp styles:production
$ gulp styles:development
```

**Note**: gulp will run `uncss` task after compile less files on production. You need create fake content to accomplish that and [Phantom.js](http://phantomjs.org) will make magic.

Build vendors and scripts on production:

```bash
$ gulp scripts:app
$ gulp scripts:vendors
```

Build Wordpress Theme and generate a zip file.

```bash
$ gulp theme
```


So easy!

