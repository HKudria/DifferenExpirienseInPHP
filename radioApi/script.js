//hide radioControl
showRadioControl = document.querySelector('.showRadioControl');
showRadioControl.style.display = "none";

//hide Favorite chanel
showFavorite = document.querySelector('.favoriteChanel');
showFavorite.style.display = "none";

//message with status
messageClass = document.querySelector('.messageClass');
messageClass.style.display = "none";

//get focus on Włączenie/wyłączenie radia
statusButton = document.querySelector('.statusButton');

function showResponse(response){
    responseClass = document.querySelector('.showResponse');
    responseClass.style.display = "bloc";
    document.getElementById('showResponse').innerHTML = response;
}

statusButton.addEventListener('click',  function (e){
    e.preventDefault();
    fetch('api/turnRadio/')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            if (data.status=="on"){
                showRadioControl.style.display = "block";
                document.getElementById('statusLabel').innerHTML = 'Radio włączone';

            } else {
                showRadioControl.style.display = "none";
                document.getElementById('statusLabel').innerHTML = 'Radio wyłączone';
                messageClass.style.display = "none";
            }
            showResponse(data.endpoint);
        })
});

//get focus FM/AM
modeButton = document.querySelector('.modeButton');
modeButton.addEventListener('click',  function (e){
    e.preventDefault();
    fetch('api/changeMode/')
        .then(response => response.json())
        .then(data => {
            if (data.mode=="FM"){
                document.getElementById('modeLabel').innerHTML = data.mode;
                document.getElementById('chanelLabel').innerHTML = '93.00';
                document.getElementById('showMessage').innerHTML = 'Zaktres ' + data.mode;

            } else {
                document.getElementById('modeLabel').innerHTML = data.mode;
                document.getElementById('chanelLabel').innerHTML = '265.00';
                document.getElementById('showMessage').innerHTML = 'Zaktres ' + data.mode;
            }
            showResponse(data.endpoint);
        })
});

//get focus randomChanelButton
randomChanelButton = document.querySelector('.randomChanelButton');
randomChanelButton.addEventListener('click',  function (e){
    e.preventDefault();
    fetch('api/searchChanel/')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            document.getElementById('chanelLabel').innerHTML = data.rand;
            document.getElementById('showMessage').innerHTML = 'Częstotliwość wyszukana';
        })
    showResponse(data.endpoint);
});


//set chanel
setChanelButton = document.querySelector('.setChanelButton');
setChanelButton.addEventListener('click',  function (e){
    e.preventDefault();

    let getTextFromInput = document.getElementById('chanelName');
    fetch('api/chanelName/'+getTextFromInput.value+'')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            document.getElementById('chanelLabel').innerHTML = data.setChanel;
            document.getElementById('showMessage').innerHTML = 'Częstotliwość ustawiona';
        })
    showResponse(data.endpoint);
});

//write to favorite stations
saveChanelButton = document.querySelector('.saveChanelButton');
saveChanelButton.addEventListener('click',function (e){
    e.preventDefault();
    let getTextFromLabel = document.getElementById('chanelLabel');
    fetch('api/saveToFavorite/'+getTextFromLabel.innerText+'')
        .then(response => response.json())
        .then(data => {
            document.getElementById('showMessage').innerHTML = data.mess;
            messageClass.style.display = "block";
        })
    showResponse(data.endpoint);
});

//read all channels
let isOptions = false;
readChanelButton = document.querySelector('.readChanelButton');
readChanelButton.addEventListener('click',function (e){
    e.preventDefault();
    fetch('api/getFavorite')
        .then(response => response.json())
        .then(data => {
            let getFocus = document.getElementById('fChanel');

            //clear options list
            if(isOptions == true){
                let opt = document.getElementById('fChanel');
                let length =  opt.options.length-1;
                for(let i = length; i >= 0; i--) {
                    opt.remove(i);
                }
                isOptions = false;
            }
            showFavorite.style.display = "block";
            for (let i = 0; i < data.favorite.length; i++) {
                let newOption = new Option(data.favorite[i], data.favorite[i]);
                getFocus.options[getFocus.options.length]=newOption;
            }
            isOptions = true;
            document.getElementById('showMessage').innerHTML = 'Częstotliwośći odczytane';
        })
    showResponse(data.endpoint);
});

//set favorite chanel
function getValue(){
    let selectedValue = fChanel.value;
    fetch('api/setFavorite/'+selectedValue+'')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            document.getElementById('chanelLabel').innerHTML = data.setFavorite;
            document.getElementById('showMessage').innerHTML = 'Częstotliwość ustawiona';
        })
    showResponse(data.endpoint);
}
