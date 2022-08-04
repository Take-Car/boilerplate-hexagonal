const path = require('path')

/** @type {import('ts-jest/dist/types').InitialOptionsTsJest} */
module.exports = {
  preset: 'ts-jest',
  testEnvironment: 'jsdom',
  moduleNameMapper: {
    '^components(.*)$': '<rootDir>/src/components$1',
    '^styles(.*)$': '<rootDir>/src/styles$1',
    '^hooks(.*)$': '<rootDir>/src/hooks$1'
  }
};