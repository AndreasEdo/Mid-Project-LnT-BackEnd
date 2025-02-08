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
    

        const visibleUsers = filteredUsers.filter(user => {
            let userId = String(user.id); // Ensure it's a string
            return (userId.startsWith('U'));
        });
    
        visibleUsers.forEach((user, index) => {
            tableHTML += `
            <tr>
                <th scope="row"><?php echo $num++?></th>
                <td class="d-flex justify-content-center">
                    <img src="<?= empty($user['photo']) ? 'https://via.placeholder.com/180x150' : '../img/'. $user['photo']?>" 
                        alt="profile_picture" 
                        style="width: 100px; border-radius: 50%; height:100px;">
                </td>
                <td><?php echo $user['first_name'].' '. $user['last_name']?> </td>
                <td><?php echo $user['email']?> </td>
                <td>
                    <a href="detailuser.php?id=<?= urlencode($user['id']) ?>" class="btn btn-primary btn-md">View</a>
                    <a href="editUser.php?id=<?= $user['id'] ?>" class="btn btn-warning btn-md">Edit</a>
                    <button class="btn btn-danger btn-md" onclick="openModal('warningRemove<?= $user['id'] ?>')">Remove</button>
                </td>
            </tr>
            <div class="warning"  id="warningRemove<?= $user['id'] ?>" >
                <div class="warning-wrapper" style="text-align: left">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $user["id"] ?>">
                        <input type="hidden" name="photo" value="<?= $user["photo"] ?>">
                        <img src="assets/warning-icon.png" class="warning-icon">
                        <h5 class="h5-warning">Are you sure you want to delete</h5><h5 class="warning-name"><?php echo $user['first_name'].' '. $user['last_name']?></h5>
                        <div class="button-wrapper">
                            <button type="submit" class="btn btn-danger" name="deleteBtn">Yes</button>
                            <button type="button" class="btn btn-secondary" onclick="closeModal('warningRemove<?= $user['id'] ?>')">No</button>
                        </div>
                    </form>
                </div>
            </div>
            `;
        });
    
        tableWrapper.innerHTML = tableHTML;
        usersCount.innerHTML = 'Total Users: ' + visibleUsers.length; 
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
    
    


});