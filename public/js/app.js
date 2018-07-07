document.addEventListener('DOMContentLoaded', function() {
    //Initialize all the components of materialize css
    M.AutoInit();
});

document.querySelector('select').addEventListener('change' , function(){
    document.querySelector('form').submit();
})