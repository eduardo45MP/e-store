<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Esta opção define o "guard" padrão de autenticação e o "broker" de 
    | redefinição de senha para sua aplicação. Você pode alterar esses 
    | valores conforme necessário, mas eles são um bom ponto de partida.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),  // Define o guard padrão, geralmente 'web'
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),  // Define o broker de senhas padrão
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Aqui, você pode definir cada guard de autenticação para sua aplicação.
    | Por padrão, é utilizada a sessão com o provedor de usuários do Eloquent.
    |
    | Todos os guards têm um provedor de usuários, que define como os usuários 
    | são recuperados do banco de dados ou outro sistema de armazenamento.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',  // O driver que gerencia a sessão do usuário
            'provider' => 'users',  // O provedor que será usado para autenticar os usuários
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Aqui você pode configurar os provedores de usuários que definem como os 
    | usuários são recuperados do banco de dados ou outro sistema.
    |
    | Se você tiver múltiplas tabelas ou modelos de usuários, pode configurar
    | vários provedores e atribuí-los aos guards que precisar.
    |
    | Suportado: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',  // Define o provedor utilizando o Eloquent (ORM do Laravel)
            'model' => env('AUTH_MODEL', App\Models\User::class),  // O modelo de usuário utilizado
        ],

        // Configuração alternativa usando o banco de dados diretamente:
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | As opções de redefinição de senha especificam o comportamento da 
    | funcionalidade de redefinição, incluindo a tabela usada para armazenar 
    | tokens e o provedor para recuperar os usuários.
    |
    | O tempo de expiração define por quantos minutos o token de redefinição 
    | será válido. A opção "throttle" impede a geração de muitos tokens em 
    | pouco tempo, para aumentar a segurança.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',  // Provedor de usuários para quem a redefinição é aplicada
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),  // Tabela para armazenar tokens
            'expire' => 60,  // Duração do token de redefinição em minutos
            'throttle' => 60,  // Tempo em segundos entre as gerações de tokens
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Define o tempo, em segundos, antes que a janela de confirmação de senha
    | expire, exigindo que os usuários insiram sua senha novamente.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),  // Tempo de expiração para confirmação de senha (3 horas)

];
