const path = require('path');

module.exports = {
    mode: 'development',
    entry: {
        homepage_header: path.resolve(__dirname, 'web/assets/components/homepage/header/js/header.js'),
        homepage_slider: path.resolve(__dirname, 'web/assets/components/homepage/slider/js/slider.js'),
    },
    output: {
        path: path.resolve(__dirname, 'web', 'build'),
        filename: '[name].[contenthash].js',
        clean: true
    },
    module: {
        rules: [
            {
                test: /\.css$/i,
                use: ["style-loader", "css-loader"],
            }
        ]
    },
    optimization: {
        splitChunks: {
            cacheGroups: {
                commons: {
                    test: /[\\/]node_modules[\\/]/,
                    // cacheGroupKey here is `commons` as the key of the cacheGroup
                    name(module, chunks, cacheGroupKey) {
                        const moduleFileName = module
                            .identifier()
                            .split('/')
                            .reduceRight((item) => item);
                        const allChunksNames = chunks.map((item) => item.name).join('~');
                        return `${cacheGroupKey}-${allChunksNames}-${moduleFileName}`;
                    },
                    chunks: 'all',
                },
            },
        },
    },
};
