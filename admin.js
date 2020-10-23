const boutonAjout = document.getElementById('toggleAdd');
const formAjout = document.getElementById('toggleForm');
boutonAjout.addEventListener('click',function(){
    if(formAjout.className == 'invisible'){
        formAjout.classList.remove('invisible')
        formAjout.classList.add('visible');
    } else{
        formAjout.classList.remove('visible')
        formAjout.classList.add('invisible');
    }
    
})