document.addEventListener('DOMContentLoaded', function () {
    const dd = document.getElementById('dropdownSearch');
    const searchInput = document.getElementById('search-input');
    const tableWrapper = document.getElementById('table-wrapper');
    const usersCount = document.getElementById('user-count');
    console.log(users);

    function searchBy(variable) {
        if (dd.innerText !== variable) {  
            dd.innerHTML = variable; 
        }
        searchInput.value = '';
        
        populateTable(users);
    }


    const dropdownItems = document.querySelectorAll('.dropdown-search');
    dropdownItems.forEach(item => {
        item.addEventListener('click', function () {
            searchBy(item.innerText);
        });
    });
    




    function populateTable(filteredUsers) {
        let tableHTML = '';
        filteredUsers.forEach((user, index) => {
            tableHTML += `
                <tr>
                    <th scope="row">${index + 1}</th>
                    <td class="d-flex justify-content-center">
                        <img src="${user.photo ? '../img/' + user.photo : 'https://via.placeholder.com/180x150'}" 
                             alt="profile_picture" 
                             style="width: 100px; border-radius: 50%; height:100px;">
                    </td>
                    <td>${user.first_name} ${user.last_name}</td>
                    <td>${user.email}</td>
                    <td>
                        <a href="#" class="btn btn-primary btn-md">View</a>
                        <a href="#" class="btn btn-warning btn-md">Edit</a>
                        <a href="#" class="btn btn-danger btn-md">Delete</a>
                    </td>
                </tr>
            `;
        });
        
        tableWrapper.innerHTML = tableHTML;

        usersCount.innerHTML = 'Total Users: ' + filteredUsers.length;

        
    }

    searchInput.addEventListener('input', function(event) {
        const searchValue = searchInput.value.toLowerCase();
        
        if (event.key === 'Enter') {
            searchInput.value = searchInput.value;
            searchInput.blur();
        }
        
        const ddInner = dd.innerText;
        let filteredUsers = [];
        if(ddInner === 'Email') {
            filteredUsers = users.filter(user => {
                const email = user.email.toLowerCase();
                return email.includes(searchValue);
            });
        } else { 
            filteredUsers = users.filter(user => {
                const fullName = (user.first_name + ' ' + user.last_name).toLowerCase();
                return fullName.includes(searchValue);
            });
        }

    
        populateTable(filteredUsers);
    


    });
    
    


    

    populateTable(users);
});