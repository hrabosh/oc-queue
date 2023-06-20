<?php
namespace Hrabja\OcQueue\Exception;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class QueueException implements ExceptionHandler {
    /**
     * Report or log an exception.
     *
     * @param  Throwable  $e
     * @return void
     */
    public function report(Throwable $e)
    {
        //处理异常
    }

    public function shouldReport(Throwable $e) {
        //
    }
    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
    }
    /**
     * Render an exception to the console.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @param  Throwable  $e
     * @return void
     */
    public function renderForConsole($output, Throwable $e)
    {
        $this->report($e);
    }
}