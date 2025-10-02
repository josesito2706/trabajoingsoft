<?php
// vistas/frmImprimirSeguimiento.php
include("../modelos/conexion.php");

if (!isset($_GET['idS'])) {
    die("ID de seguimiento no proporcionado");
}
$idS = (int)$_GET['idS'];

$sql = "
  SELECT
    s.codigo             AS codigo,
    s.cliente_dni        AS dni,
    c.nombre             AS nombre,
    c.correo             AS correo,
    c.telefono           AS telefono,
    s.estado             AS estado,
    s.descripcion        AS observacion,
    s.fecha_registro     AS fecha_seguimiento
  FROM TSolicitudes AS s
  JOIN TCliente     AS c
    ON s.cliente_dni = c.dni
  WHERE s.idS = $idS
";
$res = mysqli_query($cn, $sql);
if (!$res || mysqli_num_rows($res) === 0) {
    die("Seguimiento no encontrado");
}
$row = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <title>Detalle Seguimiento #<?= $idS ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <style>
    :root {
      --verde-agua:   #20c997;
      --turquesa:     #37d1b1;
      --gris-fondo:   #e0e0e0;    /* Oscurecido para destacar la tarjeta */
      --gris-claro:   #ffffff;
      --texto:        #333;
      --gris-texto:   #555;
    }
    * { box-sizing: border-box; margin:0; padding:0 }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: var(--gris-fondo);
      color: var(--texto);
      padding: 30px 0 60px;
      position: relative;
      min-height: 100vh;
    }
    @keyframes fadeIn {
      to { opacity:1; transform: translateY(0); }
    }
    .card {
      max-width: 600px;
      margin: auto;
      background: var(--gris-claro);
      border-radius: 12px;
      border: 1px solid rgba(0,0,0,0.1);       /* Borde sutil */
      box-shadow: 0 6px 24px rgba(0,0,0,0.12);  /* Sombra más pronunciada */
      overflow: hidden;
      opacity: 0;
      transform: translateY(20px);
      animation: fadeIn 0.6s forwards ease-out;
    }
    .card-header {
      background: linear-gradient(45deg, var(--verde-agua), var(--turquesa));
      color: white;
      padding: 20px 30px;
      font-size: 1.25rem;
      font-weight: bold;
    }
    .card-body {
      padding: 30px;
    }
    .card-body h1 {
      text-align: center;
      color: var(--verde-agua);
      margin-bottom: 20px;
      font-size: 1.5rem;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }
    td {
      padding: 12px 8px;
      vertical-align: top;
      border-bottom: 1px solid #eee;
    }
    td.label {
      font-weight: 600;
      color: var(--gris-texto);
      width: 35%;
    }
    tr:nth-child(even) td { background: #fafafa; }
    .action-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-top: 20px;
    }
    .action-buttons button {
      padding: 10px 24px;
      font-size: 1rem;
      font-weight: bold;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      color: white;
      transition: background-color .2s, transform .1s;
    }
    .btn-print {
      background: var(--verde-agua);
    }
    .btn-print:hover {
      background: var(--turquesa);
      transform: translateY(-2px);
    }
    .btn-download {
      background: var(--turquesa);
    }
    .btn-download:hover {
      background: var(--verde-agua);
      transform: translateY(-2px);
    }
    .footer {
      text-align: center;
      padding: 12px;
      background-color: var(--gris-claro);
      color: var(--gris-texto);
      font-size: 14px;
      position: absolute;
      bottom: 0;
      width: 100%;
    }
    @media print {
      .action-buttons, .card-header, .footer { display: none !important; }
      body { background: white; padding:0; }
      .card { box-shadow: none; border-radius:0; margin:0; }
    }
  </style>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>
<body>
  <div class="card" id="printableCard">
    <div class="card-header">Detalle de Seguimiento</div>
    <div class="card-body">
      <h1>#<?= htmlspecialchars($idS) ?></h1>
      <table>
        <tr><td class="label">Código:</td><td><?= htmlspecialchars($row['codigo']) ?></td></tr>
        <tr><td class="label">DNI:</td><td><?= htmlspecialchars($row['dni']) ?></td></tr>
        <tr><td class="label">Nombre:</td><td><?= htmlspecialchars($row['nombre']) ?></td></tr>
        <tr><td class="label">Correo:</td><td><?= htmlspecialchars($row['correo']) ?></td></tr>
        <tr><td class="label">Teléfono:</td><td><?= htmlspecialchars($row['telefono']) ?></td></tr>
        <tr><td class="label">Estado:</td><td><?= htmlspecialchars($row['estado']) ?></td></tr>
        <tr><td class="label">Observación:</td><td><?= nl2br(htmlspecialchars($row['observacion'])) ?></td></tr>
        <tr><td class="label">Fecha Seguimiento:</td><td><?= htmlspecialchars($row['fecha_seguimiento']) ?></td></tr>
      </table>
      <div class="action-buttons">
        <button class="btn-print" onclick="window.print()">🖨️ Imprimir</button>
        <button class="btn-download" id="btnDownload">⬇️ Descargar PDF</button>
      </div>
    </div>
  </div>

  <div class="footer">
    © 2025 ARIS Industrial. Todos los derechos reservados.
  </div>

  <script>
    const { jsPDF } = window.jspdf;
    const btnDownload   = document.getElementById('btnDownload');
    const actionButtons = document.querySelector('.action-buttons');

    btnDownload.addEventListener('click', () => {
      actionButtons.style.display = 'none';
      html2canvas(document.getElementById('printableCard'), { scale: 2 })
        .then(canvas => {
          const imgData = canvas.toDataURL('image/png');
          const pdf = new jsPDF({ orientation: 'portrait', unit: 'pt', format: 'a4' });
          const pageWidth = pdf.internal.pageSize.getWidth();
          const imgWidth  = pageWidth - 40;
          const imgHeight = canvas.height * imgWidth / canvas.width;
          pdf.addImage(imgData, 'PNG', 20, 20, imgWidth, imgHeight);
          pdf.save(`seguimiento_${<?= $idS ?>}.pdf`);
        })
        .finally(() => {
          actionButtons.style.display = '';
        });
    });
  </script>
</body>
</html>
