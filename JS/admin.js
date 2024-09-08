document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.view-button').forEach(button => {
        button.addEventListener('click', function() {
            const type = this.getAttribute('data-type');
            loadContent(type);
        });
    });
});

function loadContent(type) {
    const contentDiv = document.getElementById('content');
    let htmlContent = '';

    switch (type) {
        case 'user':
            htmlContent = `
                <h2>Users</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>john_doe</td>
                            <td>john@example.com</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>jane_smith</td>
                            <td>jane@example.com</td>
                        </tr>
                    </tbody>
                </table>
            `;
            break;

        case 'pharmacy':
            htmlContent = `
                <h2>Pharmacies</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>HealthPlus Pharmacy</td>
                            <td>New York</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Wellness Pharmacy</td>
                            <td>Los Angeles</td>
                        </tr>
                    </tbody>
                </table>
            `;
            break;

        case 'pharmacist':
            htmlContent = `
                <h2>Pharmacists</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>License Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Dr. Emily Clark</td>
                            <td>PH123456</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Dr. Michael Lee</td>
                            <td>PH654321</td>
                        </tr>
                    </tbody>
                </table>
            `;
            break;

        case 'feedback':
            htmlContent = `
                <h2>Feedback</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Feedback</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>john_doe</td>
                            <td>Great service!</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>jane_smith</td>
                            <td>Very helpful staff.</td>
                        </tr>
                    </tbody>
                </table>
            `;
            break;

        case 'contact':
            htmlContent = `
                <h2>Contact Us Info</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Alex Johnson</td>
                            <td>alex.johnson@example.com</td>
                            <td>Inquiry about products.</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Sarah Brown</td>
                            <td>sarah.brown@example.com</td>
                            <td>Request for support.</td>
                        </tr>
                    </tbody>
                </table>
            `;
            break;

        default:
            htmlContent = '<p>Content not available.</p>';
            break;
    }

    contentDiv.innerHTML = htmlContent;
}
