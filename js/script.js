document.addEventListener('DOMContentLoaded', function(){

    const login = document.querySelector('#login')
    if(login){
        login.addEventListener('click', function(){
            document.querySelector('#action').value = 'login';
        })
    }

    const register = document.querySelector('#register')
    if(register){
        register.addEventListener('click', function(){
            document.querySelector('.formc h3').textContent = 'Register';
            document.querySelector('#action').value = 'register';
        })
    }
    

    const menu_item = document.querySelectorAll('.menu__item')
    if(menu_item){
        menu_item.forEach(item => {
            item.addEventListener('click', (e) => {
                // document.querySelector('.helement').style.display = 'none';
                const target = e.target.dataset.target;
                _target = document.querySelector(target);
                document.querySelectorAll('.helement').forEach(e => e.style.display = 'none')
                _target.style.display = 'block';
                
            })
         })
    }
    const findWords = document.querySelector('#findWords');
    if(findWords){
        findWords.addEventListener('change', function(e){
           const char = this.value;
           document.querySelectorAll('.words').forEach((row) => {
                const text = row.children[0].textContent.toLocaleLowerCase();
                
                if(char == 'all'){
                    row.style.display = 'table-row';
                }else{
                    if(text.indexOf(char) == -1){
                        row.style.display = 'none';
                    }else{
                        row.style.display = 'table-row';
                    }
                }
           })
        })
    }

    let searchInput = document.querySelector('#search-input');
    if(searchInput){
        searchInput.addEventListener('keyup', function(){
            let count = this.value.length;
            $searchForm = document.querySelector('#search-form');
            if(count > 2){
                $searchForm.submit();
            }
        })
    }
    
});