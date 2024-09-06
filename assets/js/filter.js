document.addEventListener('DOMContentLoaded', function () {
	const filterCategoryBtns = document.querySelectorAll(
		'.filter-btn[data-category]'
	);

	const filterLetterBtns = document.querySelectorAll(
		'.filter-btn[data-letter]'
	);

	const filterTextSearch = document.getElementById('filter-text-search');

	let activeLetterBtn = false;

	// Function to apply the combined filters
	function applyFilters() {
		if (filterLetterBtns) {
			activeLetterBtn = Array.from(filterLetterBtns).find((btn) =>
				btn.classList.contains('active')
			);
		}
		const activeCategoryBtn = Array.from(filterCategoryBtns).find((btn) =>
			btn.classList.contains('active')
		);
		const filterText = filterTextSearch
			? filterTextSearch.value.toLowerCase()
			: '';

		let filterLetter = false;
		if (activeLetterBtn) {
			filterLetter = activeLetterBtn
				? activeLetterBtn.getAttribute('data-letter').toLowerCase()
				: '';
		}
		const filterCategory = activeCategoryBtn
			? activeCategoryBtn.getAttribute('data-category')
			: '';

		const filterPostItems = document.querySelectorAll('.filter-post-item');

		filterPostItems.forEach(function (filterPostItem) {
			const filterPostItemTitle = filterPostItem
				.getAttribute('data-title')
				.toLowerCase();
			const filterPostItemCategories = filterPostItem
				.getAttribute('data-category')
				.toLowerCase();

			let matchesText = true;
			let matchesLetter = true;
			let matchesCategory = true;

			if (filterText) {
				matchesText =
					filterPostItemTitle.includes(filterText) ||
					filterPostItemCategories.includes(filterText);
			}

			if (filterLetter) {
				matchesLetter = filterPostItemTitle.startsWith(filterLetter);
			}

			if (filterCategory) {
				matchesCategory = filterPostItemCategories.includes(filterCategory);
			}

			if (matchesText && matchesLetter && matchesCategory) {
				filterPostItem.classList.remove('hidden');
			} else {
				filterPostItem.classList.add('hidden');
			}
		});
	}

	if (filterTextSearch) {
		filterTextSearch.addEventListener('input', applyFilters);
	}

	filterLetterBtns.forEach(function (filterBtn) {
		filterBtn.addEventListener('click', function () {
			if (filterBtn.classList.contains('disabled')) {
				return;
			}

			filterBtn.classList.toggle('active');

			if (filterBtn.classList.contains('active')) {
				filterLetterBtns.forEach((btn) => {
					if (btn !== filterBtn) {
						btn.classList.remove('active');
					}
				});
			}

			applyFilters();
		});
	});

	filterCategoryBtns.forEach(function (filterBtn) {
		filterBtn.addEventListener('click', function () {
			filterCategoryBtns.forEach((btn) => btn.classList.remove('active'));
			filterBtn.classList.add('active');
			applyFilters();
		});
	});
});
