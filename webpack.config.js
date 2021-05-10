const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');

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
                use: ["style-loader", MiniCssExtractPlugin.loader,"css-loader"],
            }
        ]
    },
    plugins: [new MiniCssExtractPlugin()],
    optimization: {
        minimize: true,
        minimizer: [new CssMinimizerPlugin()],
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
