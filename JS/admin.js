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
    const url = `../PHP/get_data.php?type=${type}`; 

    fetch(url)
        .then(response => response.json())
        .then(data => {
            let htmlContent = '';
            if (data.length > 0) {
                htmlContent += '<table><thead><tr>';
                Object.keys(data[0]).forEach(key => {
                    htmlContent += `<th>${key.charAt(0).toUpperCase() + key.slice(1)}</th>`;
                });
                htmlContent += '<th>Action</th></tr></thead><tbody>';
                data.forEach(item => {
                    htmlContent += '<tr>';
                    Object.values(item).forEach(value => {
                        htmlContent += `<td>${value}</td>`;
                    });
                    htmlContent += `<td><button class="delete-button" data-id="${item.id}">Delete</button></td></tr>`;
                });
                htmlContent += '</tbody></table>';
            } else {
                htmlContent = '<p>No records found.</p>';
            }
            contentDiv.innerHTML = htmlContent;

            document.querySelectorAll('.delete-button').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    deleteRecord(type, id);
                });
            });
        })
        .catch(error => {
            console.error('Error fetching data:', error);
            contentDiv.innerHTML = '<p>Error loading content.</p>';
        });
}

function deleteRecord(type, id) {
    const url = `../PHP/delete_record.php?type=${type}&id=${id}`;
    fetch(url, {
        method: 'POST'
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Record deleted successfully!');
                loadContent(type); 
            } else {
                alert('Error deleting record.');
            }
        })
        .catch(error => {
            console.error('Error deleting record:', error);
            alert('Error deleting record.');
        });
}