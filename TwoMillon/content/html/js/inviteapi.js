document.getElementById('verifyForm').addEventListener('submit', function(event) {
  event.preventDefault();

  var codeValue = document.getElementById('code').value;

  if(codeValue === '2MILLION') {
    window.location.href = '/register';
  } else {
    alert('Invite code is incorrect.');
  }
});