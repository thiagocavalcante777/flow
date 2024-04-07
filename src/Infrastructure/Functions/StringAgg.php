<?php

namespace App\Infrastructure\Functions;

use Doctrine\ORM\Query\{AST\Functions\FunctionNode, AST\OrderByClause, AST\PathExpression};
use Doctrine\ORM\Query\{Lexer, Parser, QueryException, SqlWalker};

/**
 * Class StringAgg
 * @package App\Infrastructure\Functions
 */
class StringAgg extends FunctionNode
{
    /**
     * @var OrderByClause|null
     */
    private ?OrderByClause $orderBy = null;

    /**
     * @var mixed|null
     */
    private $delimiter = null;

    /**
     * @var bool
     */
    private bool $isDistinct = false;

    /**
     * @var PathExpression|null
     */
    private ?PathExpression $expression = null;

    /**
     * @param SqlWalker $sqlWalker
     * @return string
     * @throws QueryException
     */
    public function getSql(SqlWalker $sqlWalker): string
    {
        return \sprintf(
            'string_agg(%s%s, %s%s)',
            ($this->isDistinct ? 'DISTINCT ' : ''),
            $sqlWalker->walkPathExpression($this->expression),
            $sqlWalker->walkStringPrimary($this->delimiter),
            ($this->orderBy ? $sqlWalker->walkOrderByClause($this->orderBy) : '')
        );
    }

    /**
     * @param Parser $parser
     * @throws QueryException
     */
    public function parse(Parser $parser): void
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $lexer = $parser->getLexer();
        if ($lexer->isNextToken(Lexer::T_DISTINCT)) {
            $parser->match(Lexer::T_DISTINCT);
            $this->isDistinct = true;
        }

        $this->expression = $parser->PathExpression(PathExpression::TYPE_STATE_FIELD);
        $parser->match(Lexer::T_COMMA);
        $this->delimiter = $parser->StringPrimary();

        if ($lexer->isNextToken(Lexer::T_ORDER)) {
            $this->orderBy = $parser->OrderByClause();
        }

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}
