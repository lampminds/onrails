<script>
// Header category dropdown functionality
$(document).ready(function() {
    $('#header-category-select').on('change', function(e) {
        e.preventDefault();
        var selectedCategory = $(this).val();
        if (selectedCategory) {
            // Redirect to store with selected category
            window.location.href = '/store?category=' + selectedCategory;
        }
    });

    // Handle search form submission
    $('.header-search form').on('submit', function(e) {
        e.preventDefault();
        var category = $('#header-category-select').val();
        var searchTerm = $('.header-search input[name="search"]').val();
        
        var url = '/store';
        var params = [];
        
        if (category) {
            params.push('category=' + category);
        }
        if (searchTerm) {
            params.push('search=' + encodeURIComponent(searchTerm));
        }
        
        if (params.length > 0) {
            url += '?' + params.join('&');
        }
        
        window.location.href = url;
    });
});
</script>
