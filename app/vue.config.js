const buildAssetsPath = 'wp-content/plugins/consumption-form/public';

// vue.config.js
module.exports = {
  chainWebpack: (config) => {
    config.module
        .rule("images")
        .test(/\.(png|jpe?g|gif|webp)(\?.*)?$/)
        .use('url-loader')
        .loader('url-loader')
        .options({
            limit: 10240,
            name: 'img/[name].[hash: 7].[ext]',
            outputPath: '../assets',
            publicPath: buildAssetsPath + '/assets'
        })
  },
};
