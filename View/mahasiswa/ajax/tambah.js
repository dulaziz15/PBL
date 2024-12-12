function tambahAjax() {
    $.ajax({
        type: 'GET',
        url: '/Pbl/routes/route.php?page=user&sub=getUser',
        success: function(data) {
            if (Array.isArray(data)) {
                let tableContent = '';
                data.forEach(user => {
                    tableContent += `
                    <option value="${user.user_id}">${user.email}</option>
                `;
                });
                $('#dataUser').append(tableContent);
            } else {
                console.error("Expected an array but received:", data);
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX request failed:", status, error);
        }
    });
}