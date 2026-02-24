<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контроль выполнения процессов</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 fw-bold text-dark">
                    <i class="fas me-2 text-primary"></i>
                    Контроль выполнения процессов
                </h1>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-gradient bg-primary text-white py-3">
                    <h5 class="card-title mb-0">
                        <i class="fas me-2"></i>Список процессов
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light sticky-top">
                            <tr>
                                <th class="border-0 py-3">Дата</th>
                                <th class="border-0 py-3">Время выполнения</th>
                                <th class="border-0 py-3">PID</th>
                                <th class="border-0 py-3">Статус</th>
                                <th class="border-0 py-3">Файл</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($processes as $process)
                                <tr @if($process->status->ps_name === \App\Enums\ProcessStatuses::FAILED) class="table-danger bg-danger-subtle" @endif>
                                    <td class="fw-semibold">
                                        {{ $process->rp_start_datetime->format('d.m.Y') }}
                                        <br><small
                                            class="text-muted">{{ $process->rp_start_datetime->format('H:i:s') }}</small>
                                    </td>
                                    <td>
                                    <span class="badge {{ $process->rp_exec_time > 5 ? 'bg-warning' : 'bg-success' }}">
                                        {{ number_format($process->rp_exec_time, 2) }} сек
                                    </span>
                                    </td>
                                    <td><code class="bg-light px-2 py-1 rounded">#{{ $process->rp_pid }}</code></td>
                                    <td>
                                        @if($process->status->ps_name === \App\Enums\ProcessStatuses::RUNNING)
                                            <span class="badge bg-info"><i class="fas fa-spinner fa-spin me-1"></i>В работе</span>
                                        @elseif($process->status->ps_name === \App\Enums\ProcessStatuses::COMPLETED)
                                            <span class="badge bg-success"><i
                                                    class="fas fa-check me-1"></i>Завершен</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-times me-1"></i>Ошибка</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($process->download_url)
                                            <a href="{{ $process->download_url }}"
                                               class="btn btn-sm btn-outline-success"
                                               download="{{ basename($process->rp_file_save_path) }}">
                                                <i class="fas fa-download me-1"></i>CSV
                                            </a>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-3x mb-3 opacity-50"></i>
                                        <p class="mb-0">Процессы не найдены</p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-light py-3">
                    {{ $processes->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
