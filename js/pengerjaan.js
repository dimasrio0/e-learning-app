const log = document.getElementById('exit');
const toast = document.querySelector('.toast');
const pg = document.querySelectorAll('.pg');

log.addEventListener('mouseleave',function(){
	toast.classList.toggle('opasiti');
});

log.addEventListener('mouseenter',function(){
	toast.classList.toggle('opasiti');
});


const vSoal = document.querySelector('.view-soal');
const dView = document.querySelector('.det-view');
const tulisan = document.querySelector('.view-soal span');

vSoal.addEventListener('click', function(){
	vSoal.classList.toggle('awal');
	dView.classList.toggle('hilang');
	dView.classList.toggle('atas');
	if (vSoal.getAttribute('class') == "view-soal awal") {
		tulisan.innerHTML = " « " ;
	}else if (vSoal.getAttribute('class') == "view-soal"){
		tulisan.innerHTML = " » " ;
	}
});

for (var i = 0; i < pg.length; i++) {
	pg[i].addEventListener('click', function(e){
		const name = e.target.getAttribute('name');
		const jawaban = document.querySelector('.nomor span.'+name+' ');
		const kot = document.getElementById(name);
		const ragu = document.querySelector('.ragu #ragu');
		kot.classList.add('terisi');
		jawaban.innerHTML = "<pre>"+ e.target.value +"</pre>";
		ragu.removeAttribute('disabled');
		console.log('terisi 0');

		if (kot.classList.contains('ragu-ragu') && kot.classList.contains('terisi')) {
			console.log('terisi dan ragu-ragu 1');
			kot.classList.remove('terisi');
			kot.classList.add('ragu-ragu');
		}else if(kot.classList.contains('terisi')){
			ragu.addEventListener('input',function(){
				kot.classList.toggle('ragu-ragu');

				if (kot.classList.contains('terisi') && kot.classList.contains('ragu-ragu')) {
					console.log('terisi dan ragu-ragu 2');
					kot.classList.remove('ragu-ragu');
					kot.classList.add('terisi');
				}else{
					console.log('terisi 3');
					kot.classList.remove('terisi');
					kot.classList.add('ragu-ragu');
				}
			});
		}
	});
}





