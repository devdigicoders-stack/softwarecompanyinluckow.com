@props([
    'category' => 'general'
])

<div class="comparison-table-wrapper my-4">
    <div class="p-3 bg-dark text-white d-flex align-items-center justify-content-between">
        <h5 class="fw-bold mb-0 text-white"><i class="bi bi-sliders me-2 text-primary"></i> Objective Software Provider Evaluation Matrix</h5>
        <span class="badge bg-secondary text-uppercase" style="font-size: 0.7rem;">Selection Guide</span>
    </div>
    <div class="table-responsive">
        <table class="table comparison-table mb-0">
            <thead>
                <tr>
                    <th style="width: 25%;">Evaluation Criteria</th>
                    <th style="width: 45%;">What to Check / Key Considerations</th>
                    <th style="width: 30%;">Recommended Standard</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="fw-bold text-dark"><i class="bi bi-gear-wide-connected text-primary me-2"></i> Customization</td>
                    <td>Ensure software is tailored to your specific business workflows rather than generic off-the-shelf scripts.</td>
                    <td><span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1"><i class="bi bi-check-lg"></i> Full Custom Code</span></td>
                </tr>
                <tr>
                    <td class="fw-bold text-dark"><i class="bi bi-layers text-primary me-2"></i> Technology Stack</td>
                    <td>Verify modern, scalable frameworks (Laravel, PHP 8.2+, Flutter, React, Node.js, MySQL).</td>
                    <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1"><i class="bi bi-code-slash"></i> Modern Tech Stack</span></td>
                </tr>
                <tr>
                    <td class="fw-bold text-dark"><i class="bi bi-headset text-primary me-2"></i> Support & Maintenance</td>
                    <td>Look for post-deployment bug fixes, server maintenance, SLA support, and regular updates.</td>
                    <td><span class="badge bg-info-subtle text-info border border-info-subtle px-2 py-1"><i class="bi bi-shield-check"></i> Dedicated SLA</span></td>
                </tr>
                <tr>
                    <td class="fw-bold text-dark"><i class="bi bi-shield-lock text-primary me-2"></i> Security & Compliance</td>
                    <td>Check for SSL, CSRF protection, SQL injection protection, data encryption, and role-based access control.</td>
                    <td><span class="badge bg-dark-subtle text-dark border border-dark-subtle px-2 py-1"><i class="bi bg-lock"></i> High Security</span></td>
                </tr>
                <tr>
                    <td class="fw-bold text-dark"><i class="bi bi-wallet2 text-primary me-2"></i> Pricing Transparency</td>
                    <td>Demand clear scope documentation, milestone breakdown, and no hidden cost surprises.</td>
                    <td><span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1"><i class="bi bi-file-earmark-text"></i> Scope Documentation</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
