const log = document.getElementById('exit');
const toast = document.querySelector('.log');

log.addEventListener('mouseleave',function(){
	toast.classList.toggle('opasiti');
});

log.addEventListener('mouseenter',function(){
	toast.classList.toggle('opasiti');
});