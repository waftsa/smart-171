<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.rawgit.com/inorganik/countUp.js/1.9.3/dist/countUp.min.js"></script> <!-- Load CountUp.js -->

</head>
<body>

<x-app-layout>

<x-home.slider :sliders="$sliders" />
<x-home.countup />
<x-home.about />
<x-home.donations :donations="$donations" />
<x-home.documentations :documentations="$documentations" />
<x-home.articles :articles="$articles" />
<x-home.releases :releases="$releases" />

</x-app-layout>


</body>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const sections = document.querySelectorAll("section");

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("opacity-100", "translate-y-0");
                    entry.target.classList.remove("opacity-0", "translate-y-10");
                    observer.unobserve(entry.target); // Hanya animasi 1x saat pertama terlihat
                }
            });
        }, { threshold: 0.2 });

        sections.forEach(section => {
            observer.observe(section);
        });
    });
</script>

