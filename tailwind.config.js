const colors = require('tailwindcss/colors')
const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    // prettier-ignore
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    colors: {
      transparent: 'transparent',
      current: 'currentColor',
      black: colors.black,
      white: colors.white,
      red: colors.red,
      orange: colors.orange,
      yellow: colors.yellow,
      green: colors.green,
      gray: colors.blueGray,
      coronation_purple: {
        100: '#C8C6F8',
        200: '#B1AEEA',
        300: '#9491D2',
        400: '#7B78BD',
        500: '#625F9F',
        600: '#4E4B89',
        700: '#3B386D',
        800: '#282652',
        900: '#201E45',
      },
      affluence_green: {
        100: '#CFEDCF',
        200: '#BEE3BE',
        300: '#BBDEBB',
        400: '#A8D0A8',
        500: '#97C197',
        600: '#88B288',
        700: '#7AA67A',
        800: '#699868',
        900: '#5B8C5A',
      },
      indigo: {
        100: '#e6e8ff',
        300: '#b2b7ff',
        400: '#7886d7',
        500: '#6574cd',
        600: '#5661b3',
        800: '#2f365f',
        900: '#191e38',
      },
    },
    extend: {
      borderColor: theme => ({
        DEFAULT: theme('colors.gray.200', 'currentColor'),
      }),
      fontFamily: {
        sans: ['Cerebri Sans', ...defaultTheme.fontFamily.sans],
      },
      boxShadow: theme => ({
        outline: '0 0 0 2px ' + theme('colors.indigo.500'),
      }),
      fill: theme => theme('colors'),
    },
  },
  variants: {
    extend: {
      fill: ['focus', 'group-hover'],
    },
  },
  plugins: [],
}
