const mix = require("laravel-mix");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

mix.js("resources/js/app.js", "public/js")
    .sass("resources/sass/app.scss", "public/css")
    .sourceMaps();

// Enable BrowserSync for auto-reload
if (mix.inProduction()) {
    mix.version();
} else {
    mix.browserSync({
        proxy: "http://127.0.0.1:8000", // Ganti dengan URL lokal Anda
        files: [
            "app/**/*",
            "resources/views/**/*",
            "public/**/*",
            "routes/**/*",
        ],
        injectChanges: true,
        open: false,
    });
}
