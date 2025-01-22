import antfu from "@antfu/eslint-config"

export default antfu({
  react: true,
  stylistic: {
    indent: 2,
    quotes: "double",
    semi: false,
    jsx: true,
  },
})
