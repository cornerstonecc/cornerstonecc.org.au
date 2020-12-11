/* CUSTOM WEBPACK CONFIG.

   This file extends the built in @wordpress/scripts "webpack.config" to
   allow for Typescript conversion via ts-loader.

   See the following link for usage and caveats:
   https://developer.wordpress.org/block-editor/packages/packages-scripts/#provide-your-own-webpack-config

*/

const path = require("path");
const defaultConfig = require("@wordpress/scripts/config/webpack.config");

module.exports = {
	...defaultConfig,
	entry: "./src/index.ts",
	module: {
		...defaultConfig.module,
		rules: [
			{
				test: /\.tsx?$/,
				use: "ts-loader",
				exclude: /node_modules/,
			},
			...defaultConfig.module.rules,
		],
	},

	resolve: {
		...defaultConfig.resolve,
		extensions: [".tsx", ".ts", "js", "jsx"],
	},

	output: {
		...defaultConfig.output,
		filename: "index.js",
		path: path.resolve(__dirname, "build"),
	},
};
