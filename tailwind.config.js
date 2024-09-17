/** @type {import('tailwindcss').Config} */
module.exports = {
	content: ['./*.php', './inc/**/*.php'],
	theme: {
		extend: {
			colors: {
				'cea-orange': '#ff723a',
				'cea-light-orange': '#fb9900e6',
				'cea-red': '#c20201',
				'cea-blue': '#058bb1',
				'cea-grey': '#231f2080',
			},
			ringColor: {
				DEFAULT: '#0000',
			},
		},
		fontFamily: {
			rubik: ['"Rubik"', 'sans-serif'],
		},
	},
	plugins: [
		require('tailwindcss-animate'),
		require('@tailwindcss/typography'),
		require('@tailwindcss/forms'),
	],
	corePlugins: {
		preflight: false,
	},
};
