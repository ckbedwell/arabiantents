
module.exports = {
  rules: {
    "at-rule-no-unknown": [
      true,
    ],
    "block-no-empty": true,
    "color-no-invalid-hex": true,
    "comment-no-empty": true,
    "declaration-block-no-duplicate-properties": [
      true,
    ],
    "declaration-block-no-redundant-longhand-properties": [
      true,
      {
        ignoreShorthands: [
          `font`,
          `border-bottom`,
        ],
      },
    ],
    "declaration-block-no-shorthand-property-overrides": true,
    "font-family-no-duplicate-names": true,
    "font-family-no-missing-generic-family-keyword": true,
    "function-calc-no-unspaced-operator": true,
    "function-linear-gradient-no-nonstandard-direction": true,
    "keyframe-declaration-no-important": true,
    "no-duplicate-selectors": true,
    "no-empty-source": true,
    "no-extra-semicolons": true,
    "no-invalid-double-slash-comments": true,
    "selector-pseudo-class-no-unknown": [
      true,
    ],
    "selector-pseudo-element-no-unknown": true,
    "selector-type-no-unknown": true,
    "string-no-newline": true,
    "unit-no-unknown": true,
    indentation: 2,
    "declaration-no-important": true,
    "font-weight-notation": `numeric`,
    "length-zero-no-unit": true,
    "max-nesting-depth": 2,
    "no-duplicate-at-import-rules": true,
    "number-no-trailing-zeros": true,
    "selector-max-id": 0,
    "selector-max-compound-selectors": 3,
    "selector-max-universal": 1,
    "unit-disallowed-list": [
      `em`,
    ],
    "rule-empty-line-before": "always",
    "property-disallowed-list": [
      `float`,
      `font`,
      `line-height`,
    ],
    "property-case": `lower`,
    "property-no-unknown": [
      true,
    ],
    "property-no-vendor-prefix": [
      true,
    ],
    "value-keyword-case": [
      `lower`,
    ],
  },
}
