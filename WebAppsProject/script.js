//On click to show/hide full article contents
document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.querySelectorAll('.seeArticleButton');
    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            // var content = this.parentElement.querySelector('.articleContent');
            // content.style.display = content.style.display === 'block' ? 'none' : 'block';
            var container = this.parentElement;
            var previewContent = container.querySelector('.previewContent');
            var articleContent = container.querySelector('.articleContent');

            if (articleContent.style.display === 'none' || articleContent.style.display === '') {
                articleContent.style.display = 'block';
                previewContent.style.display = 'none';
                    
            } else {
                previewContent.style.display = 'block';
                articleContent.style.display = 'none';
                }
        });
        });
});

//Prevents future date for article date.
document.addEventListener('DOMContentLoaded', function() {
    var currentDate = new Date().toISOString().split('T')[0];
    document.getElementById('date').setAttribute('max', currentDate);
});

//Checkbox has to be ticked before being able to submit
function validateForm() {
    var checkbox = document.forms["uploadArticle"]["agree"];
    if (!checkbox.checked) {
        alert("Please confirm article is ready for sumbitting.");
        return false;
    }
    return true;
}