// loading wheel
const form = document.querySelector('form');
const loadingElement = document.querySelector('.loading');
form.addEventListener('submit', () => {
  form.style.display = 'none';
  loadingElement.style = 'display: ';
})

// 
function empty() {
  const x = document.getElementById("content").value;
  if (x == "") {
    event.preventDefault()
    alert("Mew Can\'t be Empty 😿");
    return false;
  };
}