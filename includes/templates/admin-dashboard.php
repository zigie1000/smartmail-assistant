<div class="wrap">
    <h1>SmartMail Dashboard</h1>
    <div id="smartmail-dashboard-content">
        <p>Welcome to the SmartMail Dashboard. Use the sidebar to navigate through different AI-powered features.</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('.smartmail-sidebar ul li a');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                document.querySelector('#smartmail-dashboard-content').innerHTML = target.innerHTML;
            }
        });
    });
});
</script>
