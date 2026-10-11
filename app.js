document.getElementById("loginForm").addEventListener("submit", async function (e) {
  e.preventDefault();

  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const msg = document.getElementById("msg");

  // vulnerable: sent as-is to login.php, which concatenates it into SQL
  const body = new URLSearchParams({ username, password });

  const res = await fetch("login.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: body.toString(),
    redirect: "follow"
  });

  if (res.redirected) {
    window.location.href = res.url;
  } else {
    msg.textContent = "Login failed.";
  }
});