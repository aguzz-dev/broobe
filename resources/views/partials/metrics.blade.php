<div class="search-section">
    <div class="url-input">
        <input type="url" placeholder="Ingrese URL para analizar: www.ejemplo.com" />
    </div>

    <div class="categories">
        <label class="checkbox-container">
            <input type="checkbox" name="pwa">
            <span>PWA</span>
        </label>
        <label class="checkbox-container">
            <input type="checkbox" name="seo" checked>
            <span>SEO</span>
        </label>
        <label class="checkbox-container">
            <input type="checkbox" name="performance" checked>
            <span>PERFORMANCE</span>
        </label>
        <label class="checkbox-container">
            <input type="checkbox" name="best-practices" checked>
            <span>BEST-PRACTICES</span>
        </label>
        <label class="checkbox-container">
            <input type="checkbox" name="accessibility" checked>
            <span>ACCESSIBILITY</span>
        </label>

        <select class="strategy-select">
            <option value="mobile">Mobile</option>
            <option value="desktop">Desktop</option>
        </select>
    </div>

    <button class="btn-primary">GET METRICS</button>
</div>

<div class="metrics-grid">
    <div class="metric-card">
        <div class="metric-title">
            SEO
            <span class="metric-score" id="seoScore" style="display: none;margin-left:5px;color:#6f3dea;"></span>
        </div>
        <canvas id="seoChart"></canvas>
    </div>
    <div class="metric-card">
        <div class="metric-title">
            PERFORMANCE
            <span class="metric-score" id="performanceScore" style="display: none;margin-left:5px;color:#6f3dea;"></span>
        </div>
        <canvas id="performanceChart"></canvas>
    </div>
    <div class="metric-card">
        <div class="metric-title">
            BEST PRACTICES
            <span class="metric-score" id="practicesScore" style="display: none;margin-left:5px;color:#6f3dea;"></span>
        </div>
        <canvas id="practicesChart"></canvas>
    </div>
    <div class="metric-card">
        <div class="metric-title">
            ACCESSIBILITY
            <span class="metric-score" id="accessibilityScore" style="display: none;margin-left:5px;color:#6f3dea;"></span>
        </div>
        <canvas id="accessibilityChart"></canvas>
    </div>
</div>

<button class="btn-save">SAVE METRIC RUN</button>
