var zoneTotal = document.getElementById('pTotal');
var total = 0;
zoneTotal.textContent = majPrix()+' €';
document.addEventListener('click', function(e){
    //console.log(e.target.id);
    if(e.target.id.includes('plus')){
        e.preventDefault();
        var idProduit = e.target.id;
        idProduit = idProduit.replace('plus','');
        var inputNumber = document.getElementById('quant'+idProduit);
        inputNumber.value++;
        zoneTotal.textContent = majPrix()+' €';
        majForm();
    }
    if(e.target.id.includes('moins')){
        e.preventDefault();
        var idProduit = e.target.id;
        idProduit = idProduit.replace('moins','');
        var inputNumber = document.getElementById('quant'+idProduit);
        if(inputNumber.value>1){
            inputNumber.value--;
            zoneTotal.textContent = majPrix()+' €';
            majForm();
        };
    }
    if(e.target.id == 'submit'){
        e.preventDefault();
        document.querySelector('.formContact').classList.add('visible');
        
    }
})

var lesInputs = document.querySelectorAll('input[type="number"]');
lesInputs.forEach(element => {
   element.addEventListener('change', function(){
    var total =0;
    var lesPrix = document.querySelectorAll('td[id*="prix"]');
    lesPrix.forEach(element => {
        var prixElement = parseFloat(element.textContent.replace(' €',''));
        var elementId = element.id.replace('prix','');
        var quantElement = parseInt(document.getElementById('quant'+elementId).value);
        total += prixElement * quantElement;
    });
    zoneTotal.textContent = total.toFixed(2);
   }); 
});

function majPrix(){
        var total =0;
        var lesPrix = document.querySelectorAll('td[id*="prix"]');
        lesPrix.forEach(element => {
            var prixElement = parseFloat(element.textContent.replace(' €',''));
            var elementId = element.id.replace('prix','');
            var quantElement = parseInt(document.getElementById('quant'+elementId).value);
            total += prixElement * quantElement;
        });
        return total.toFixed(2);
        
    };

// function majForm(){
//     var lesHidden = document.querySelectorAll('.formContact input[type=hidden]');
//     lesHidden.forEach(element => {
//         element.value = document.getElementById('quant'+element.id.replace('hidden','')).value;
//     });

// }