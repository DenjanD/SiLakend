
$('.link').on('click', function(){
    $('.link').removeClass('active');
    $(this).addClass('active');

let judul = $(this).html();
console.log(judul);
$.getJSON('konten.json', function (data){
    let menu = data.menu;
    let content = '';
    let nama = '';
    
    $.each(menu, function (i, data){
        if(data.judul == judul){
            nama += data.nama;
            content += data.isi;
            
        }
    });
    $('#judul').html(nama);
    $('#isi').html(content);
}); 

});
