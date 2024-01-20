const mix = require('laravel-mix')
const path = require('path')

const directory = path.basename(path.resolve(__dirname))
const source = `platform/plugins/${directory}`
const dist = `public/vendor/core/plugins/${directory}`

mix.js(`${source}/resources/js/fob-floating-buttons.js`, `${dist}/js`)
    .sass(`${source}/resources/sass/fob-floating-buttons.scss`, `${dist}/css`)

if (mix.inProduction()) {
    mix.copy(`${dist}/js/fob-floating-buttons.js`, `${source}/public/js`)
    mix.copy(`${dist}/css/fob-floating-buttons.css`, `${source}/public/css`)
}
