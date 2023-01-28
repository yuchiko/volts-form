const buildAssetsPath = 'wp-content/plugins/consumption-form/public';

// vue.config.js
module.exports = {
  chainWebpack: (config) => {
    config.module.rules.delete("svg");
    config.module.rule("svg")
      .test(/\.(svg)(\?.*)?$/)
      .use("babel-loader")
      .loader("babel-loader")
      .end()
      .use("vue-svg-loader")
      .loader("vue-svg-loader");
  },
};
