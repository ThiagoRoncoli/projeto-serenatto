<?php
/*vamos inserir um require no início desse arquivo. 
Vamos inserir vendor/autoload para que aconteça a autoinclusão das dependências que estão no vendor.

A linha require "vendor/autoload.php"; é como se você estivesse convidando um grupo de amigos para uma festa.
Imagine que cada amigo representa uma biblioteca do PHP, como a dompdf.
Para que a festa seja animada e todos possam aproveitar, 
você precisa avisar a cada um deles que a festa vai começar, certo?

É exatamente isso que o require "vendor/autoload.php"; faz! 
Ele avisa ao PHP que você quer usar as bibliotecas que estão na pasta vendor, 
como a dompdf, para que elas possam ser usadas no seu código.
*/


require "vendor/autoload.php";

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

/*ob_start();: Essa função inicia o buffer de saída no PHP. 
Isso significa que qualquer saída (por exemplo, echo, print) que normalmente iria diretamente
para o navegador será capturada no buffer em vez de ser enviada imediatamente.
require "conteudo-pdf.php";: Aqui, o arquivo conteudo-pdf.phpestá incluído e concluído. 
Em vez de enviar qualquer saída diretamente ao navegador, o conteúdo gerado é capturado 
no buffer de saída iniciado pela função ob_start().
$html = ob_get_clean();: A função ob_get_clean()obtida o conteúdo armazenado no buffer de saída e, 
ao mesmo tempo, limpa (ou seja, esvaziado) o buffer. Esse conteúdo capturado é então atribuído à 
variável $html.
*/

ob_start();
require "conteudo-pdf.php";
$html = ob_get_clean();

$dompdf->loadHtml($html);

// Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

?>