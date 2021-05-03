const path = require('path');

module.exports = {
    entry: {
        homepage_header: path.resolve(__dirname, 'web/assets/components/homepage/header/js/header.js'),
        homepage_slider: path.resolve(__dirname, 'web/assets/components/homepage/slider/js/slider.js'),
    },
    output: {
        path: path.resolve(__dirname, 'web', 'build'),
        chunkFilename: '[id].js',
    }
};
