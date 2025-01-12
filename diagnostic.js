document.getElementById('diagnostic').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from submitting the traditional way

    const name = document.getElementById('name').value;
    const contact = document.getElementById('contact').value;
    const device = document.getElementById('device').value;
    const issue = document.getElementById('issue').value;
    const contactMethod = document.querySelector('input[name="contactMethod"]:checked').value;

    // Confirmation message
    const confirmationDiv = document.getElementById('confirmation');
    confirmationDiv.innerHTML = `
        <h3>Thank you, ${name}!</h3>
        <p>We have received your request:</p>
        <ul>
            <li><strong>Contact:</strong> ${contact}</li>
            <li><strong>Device:</strong> ${device}</li>
            <li><strong>Issue:</strong> ${issue}</li>
            <li><strong>Preferred Contact Method:</strong> ${contactMethod}</li>
        </ul>
        <p>We will get back to you shortly!</p>
    `;

    // Reset the form
    document.getElementById('diagnostic').reset();
});
