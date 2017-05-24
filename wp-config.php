<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa user o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações
// com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'br_blog_loojas');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '123456');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         ',E)6s;i6)/S`aE~zC$*.h:<Mw~7R3k]zq1*?Hwez0pj=EH poVGK](Z-%rSk|&.3');
define('SECURE_AUTH_KEY',  'Di7BUVXD^@8J|h1WT69XgeSzD6Y&;>f2NG*u|W%+(jmsPjjx-2crK[^Ea|*vJ$R?');
define('LOGGED_IN_KEY',    '|_|hw6s`&%r7PGw/HE;d}#cf~(s,4<=g4p?s17oE@/<R]`__g,>sqv?2(T[qF(XD');
define('NONCE_KEY',        '-CbJ6!IbNlb#-o.~3nc3}=$L0D_vX;TnY{{`xx(-a9J7i2LfH5 9aC+JLLHzM{v_');
define('AUTH_SALT',        'Wt]5gU^[R?6[gfq*~&6?kpg-+de0/qg2/h&tkSm^>IfF_E+N!.{Ff|(>QXca(,~1');
define('SECURE_AUTH_SALT', '*sBw[Vtbr~f.UE6jwJNxT>6|!WFjIewHQ42 MdCbKggA.lnrs!!GWEr].}[s.19,');
define('LOGGED_IN_SALT',   'SI87NRm#~[.P!>[[6EY.At`:&TaX.Vm-T=EQ+r?K#$(qfX0Ji^uFge8b83_Na5mz');
define('NONCE_SALT',       '!1?HUM54pgc?}t5mA.eD]z8#IleVC_{zfF$m16%_&JngtGR4Qo$ko#2CFVZ+F=].');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * para cada um um único prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'bl_';

/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
