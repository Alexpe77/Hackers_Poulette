document.addEventListener('DOMContentLoaded', function() {
    let form = document.getElementById('contactForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        let name = document.getElementById('visitor_name').value;
        let fname = document.getElementById('visitor_fname').value;
        let email = document.getElementById('visitor_email').value;
        let desc = document.getElementById('visitor_message').value;

        if (name.trim() === '' || fname.trim() === '' || email.trim() === '' || desc.trim() === '') {
            alert('Please fill in all the required fields.');
            return;
        }
    });
});