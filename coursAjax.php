AJAX = Asynchronous JavaScript + XML


<!-- Affichage de l'heure sans rechargement : -->
Dans le php (view):

input heure
btn


Dans le php : controllers/ajax/getTimeFromBack.php :
<?php
$time = date('H:i:s');

echo json_encode($time);
?>


Dans le script JS :
<script>
    let btn_time = document.getElementById('btn_time');
    const getTimeFromBack = () => {
        // je récupère dans le dossier où se trouve mes scripts ajax le fichier :
        fetch('/controllers/ajax/getTimeFromBack.php')
            // pour le récupérer dans le front le .then attend une fonction flèchée :
            // je le stocke dans response :
            .then(response => {
                console.log(response)
                // je récupère juste le contenu en json:
                return (response.json())
            })
            // je l'affiche avec data:
            .then(data => {
                console.log(data)
                let time = document.getElementById('time');
                time.innerHTML = data;
            })
    }
    btn_time.addEventListener('click', getTimeFromBack);
</script>

Dans le navigateur > inspecter code > network > preview :
on voit l'action menée par la demande.

<!-- ========================================================================================================== -->

<!-- Liste d'étudiants : -->

Dans le php (view):

ul = id=students li> étudiants

btn


Dans le php : controllers/ajax/getStudents.php :

$studentsElement = getall fonctionphp;

echo json_encode($students);



Dans le script JS :
<script>
    let btn = document.getElementById('btn');
    const getStudents = () => {
        studentsElement.innerHTML = ``;
        // je récupère dans le dossier où se trouve mes scripts ajax le fichier :
        fetch('controllers/ajax/getStudents.php')
            // pour le récupérer dans le front le .then attend une fonction flèchée :
            // je le stocke dans response :
            .then(response => {
                console.log(response)
                // je récupère juste le contenu en json:
                return (response.json())
            })
            // je l'affiche avec data:
            .then(students => {
                let students = document.getElementById('students');
                students.array.forEach(student => {
                    studentsElement.innerHTML += `<li>${student}</li>`;
                });
                
            })
    }
    btn.addEventListener('click', getStudents);
</script>

<!-- ========================================================================================================== -->

les codes postaux :

Dans le php (view):

input id=zipCodeElement 

btn


Dans le php : controllers/ajax/getCode.php :
<?php
$ch = curl_init('lienApipour les codes postaux');

curl_exec($ch);

curl_close($ch)
?>


Dans le script JS :
<script>
    let btnZip = document.getElementById('btnZip');
    const getCode = () => {
        studentsElement.innerHTML = ``;
        // je récupère dans le dossier où se trouve mes scripts ajax le fichier :
        fetch('controllers/ajax/getCode.php')
            // pour le récupérer dans le front le .then attend une fonction flèchée :
            // je le stocke dans response :
            .then(response => {
                console.log(response)
                // je récupère juste le contenu en json:
                return (response.json())
            })
            // je l'affiche avec data:
            .then(students => {
                let zipCodeElement = document.getElementById('zipCodeElement');
                zipCodes.array.forEach(zipCode => {
                    zipCodeElement.innerHTML += `<li>${zipcode}</li>`;
                });
                
            })
    }
    btnZip.addEventListener('click', getCode);
</script>
