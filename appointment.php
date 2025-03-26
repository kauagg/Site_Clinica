<?php
// config.php - Arquivo de configuração (coloque em um local seguro)
$whatsapp_number = "5511999999999"; // Substitua pelo seu número com código do país
$website_name = "Seu Site de Saúde"; // Nome do seu site/serviço

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Coleta e sanitiza os dados do formulário
    $firstName = htmlspecialchars($_POST['firstName']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender']);
    $appointmentDate = htmlspecialchars($_POST['appointmentDate']);
    $department = htmlspecialchars($_POST['department']);
    $comments = htmlspecialchars($_POST['comments']);
    
    // Validação básica
    $errors = [];
    
    if (empty($firstName)) {
        $errors[] = "O nome é obrigatório.";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Por favor, insira um e-mail válido.";
    }
    
    if (empty($phone)) {
        $errors[] = "O telefone é obrigatório.";
    }
    
    if (empty($appointmentDate)) {
        $errors[] = "Por favor, selecione uma data para o agendamento.";
    }
    
    // Se houver erros, exibe-os
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger'>$error</div>";
        }
    } else {
        // Formata a mensagem para o WhatsApp
        $whatsapp_message = "📅 *Novo Agendamento* 📅\n\n";
        $whatsapp_message .= "*Nome:* $firstName\n";
        $whatsapp_message .= "*Email:* $email\n";
        $whatsapp_message .= "*Telefone:* $phone\n";
        $whatsapp_message .= "*Gênero:* $gender\n";
        $whatsapp_message .= "*Data do Agendamento:* $appointmentDate\n";
        $whatsapp_message .= "*Departamento:* $department\n";
        $whatsapp_message .= "*Comentários:* $comments\n\n";
        $whatsapp_message .= "Enviado através do $website_name";
        
        // Codifica a mensagem para URL
        $encoded_message = urlencode($whatsapp_message);
        
        // Cria o link do WhatsApp
        $whatsapp_url = "https://wa.me/$whatsapp_number?text=$encoded_message";
        
        // Redireciona para o WhatsApp
        header("Location: $whatsapp_url");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendamento</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .appointment-form {
            background-color: #1a1a1a;
            color: white;
        }
        .border-primary {
            border-color: #0d6efd !important;
        }
    </style>
</head>
<body>
<div class="container-fluid appointment py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="section-title text-start">
                    <h4 class="sub-title pe-3 mb-0">Solutions To Your Pain</h4>
                    <h1 class="display-4 mb-4">Best Quality Services With Minimal Pain Rate</h1>
                    <p class="mb-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat deleniti amet at atque sequi quibusdam cumque itaque repudiandae temporibus, eius nam mollitia voluptas maxime veniam necessitatibus saepe in ab? Repellat!</p>
                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Body Relaxation</h5>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et deserunt qui cupiditate veritatis enim ducimus.</p>
                                </div>
                                <div class="mb-4">
                                    <h5 class="mb-3"><i class="fa fa-check text-primary me-2"></i> Body Relaxation</h5>
                                    <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et deserunt qui cupiditate veritatis enim ducimus.</p>
                                </div>
                                <div class="text-start mb-4">
                                    <a href="#" class="btn btn-primary rounded-pill text-white py-3 px-5">More Details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="video h-100">
                                <img src="img/video-img.jpg" class="img-fluid rounded w-100 h-100" style="object-fit: cover;" alt="">
                                <button type="button" class="btn btn-play" data-bs-toggle="modal" data-src="https://www.youtube.com/embed/DWRcNpR6Kdc" data-bs-target="#videoModal">
                                    <span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="appointment-form rounded p-5">
                    <p class="fs-4 text-uppercase text-primary">Get In Touch</p>
                    <h1 class="display-5 mb-4">Get Appointment</h1>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row gy-3 gx-4">
                            <div class="col-xl-6">
                                <input type="text" name="firstName" class="form-control py-3 border-primary bg-transparent text-white" placeholder="First Name" required>
                            </div>
                            <div class="col-xl-6">
                                <input type="email" name="email" class="form-control py-3 border-primary bg-transparent text-white" placeholder="Email" required>
                            </div>
                            <div class="col-xl-6">
                                <input type="tel" name="phone" class="form-control py-3 border-primary bg-transparent" placeholder="Phone" required>
                            </div>
                            <div class="col-xl-6">
                                <select name="gender" class="form-select py-3 border-primary bg-transparent" aria-label="Default select example" required>
                                    <option value="" selected disabled>Your Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            <div class="col-xl-6">
                                <input type="date" name="appointmentDate" class="form-control py-3 border-primary bg-transparent" required>
                            </div>
                            <div class="col-xl-6">
                                <select name="department" class="form-select py-3 border-primary bg-transparent" aria-label="Default select example" required>
                                    <option value="" selected disabled>Department</option>
                                    <option value="Physiotherapy">Physiotherapy</option>
                                    <option value="Physical Health">Physical Health</option>
                                    <option value="Treatments">Treatments</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-primary bg-transparent text-white" name="comments" id="area-text" cols="30" rows="5" placeholder="Write Comments"></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary text-white w-100 py-3 px-5">SUBMIT NOW</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
