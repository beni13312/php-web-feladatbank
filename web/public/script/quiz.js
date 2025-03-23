
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.quiz-ans').forEach(element => {
        element.addEventListener('click', function() {
            this.querySelector('.quiz-ans-ch input[type="radio"]').checked = true;
        });
    });
    document.querySelectorAll('.quiz-ans').forEach(element => {
        element.addEventListener('click', function(event) {
            const checkbox_e = this.querySelector('.quiz-ans-ch input[type="checkbox"]');
            if(event.target !== checkbox_e){

                checkbox_e.checked = !checkbox_e.checked;
            }

        });
    });
});