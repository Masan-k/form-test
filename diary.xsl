<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="html" encoding="UTF-8"/>

  <!-- ルートテンプレート：XML全体をHTMLに変換 -->
  <xsl:template match="/">
    <html>
      <head>
        <!-- Google tag (gtag.js) -->
        <script async="async" src="https://www.googletagmanager.com/gtag/js?id=G-N5S8WBQQKX"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'G-N5S8WBQQKX');
        </script>

        <meta charset="UTF-8" />
        <title>dewotai</title>
        <link rel="stylesheet" href="css/bootstrap.min.css"/>
      </head>
      <body>
        <!-- 各エントリに対してテンプレートを適用 -->
        <div class="container mt-3">
          <a href="./diary.xml">news</a>
          <xsl:apply-templates select="diary/entry">
            <xsl:sort select="date" data-type="text" order="descending"/>
          </xsl:apply-templates>
        </div>



      </body>
    </html>
  </xsl:template>

  <!-- 各日記エントリの変換テンプレート -->
  <xsl:template match="entry">
    <div class="row mb-1 pt-1 pb-1 border-top border-subtle">
      <div class="col-auto" style="width:150px;">
        <xsl:value-of select="date"/>
      </div>
      <div class="col" style="white-space: pre-wrap;">
        <xsl:variable name="titleValue" select="title"/>
        <xsl:if test="normalize-space($titleValue) != ''">
          <span class="fst-italic fw-bold"><xsl:value-of select="$titleValue"/></span>
          <br/> 
        </xsl:if>
        <xsl:value-of select="content"/>
      </div>
    </div>
  </xsl:template>
</xsl:stylesheet>
