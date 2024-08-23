import globals from "globals";
import pluginJs from "@eslint/js";
import pluginReact from "eslint-plugin-react";
import stylistic from '@stylistic/eslint-plugin'
import tailwind from "eslint-plugin-tailwindcss";

export default [
  { files: ["**/*.{js,mjs,cjs,jsx}"] },
  { languageOptions: { globals: globals.browser } },
  pluginJs.configs.recommended,
  {
    plugins: pluginReact.configs.flat.recommended.plugins,
    languageOptions: pluginReact.configs.flat.recommended.languageOptions,
    rules: {
      ...pluginReact.configs.flat.recommended.rules,
      "react/react-in-jsx-scope": "off",
      "react/prop-types": "off",
    }
  },
  {
    plugins: {
      '@stylistic': stylistic
    },
    rules: {
      '@stylistic/indent': ['error', 2],
    }
  },
  ...tailwind.configs["flat/recommended"]
];